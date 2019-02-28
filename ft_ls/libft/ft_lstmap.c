/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_lstmap.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: bclerc <bclerc@student.42.fr>              +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/24 10:18:08 by bclerc            #+#    #+#             */
/*   Updated: 2018/11/24 17:08:33 by bclerc           ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

t_list	*ft_lstmap(t_list *lst, t_list *(*f)(t_list *elem))
{
	t_list *tmp_lst;

	if (!lst || !f)
		return (NULL);
	tmp_lst = ft_lstnew(f(lst)->content, f(lst)->content_size);
	tmp_lst->next = ft_lstmap(lst->next, f);
	return (tmp_lst);
}

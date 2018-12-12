/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_lstmap.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/12 17:06:37 by malallai          #+#    #+#             */
/*   Updated: 2018/12/12 14:19:22 by malallai         ###   ########.fr       */
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

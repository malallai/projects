/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_memalloc.c                                      :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/11 16:18:50 by malallai          #+#    #+#             */
/*   Updated: 2018/11/19 12:17:51 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <libft.h>

void	*ft_memalloc(size_t size)
{
	void *t;

	if (!(t = malloc(size)) || size == 0)
		return (NULL);
	ft_bzero(t, size);
	return (t);
}

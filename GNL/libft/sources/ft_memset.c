/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_memset.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/07 12:29:59 by malallai          #+#    #+#             */
/*   Updated: 2018/11/19 12:48:06 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <libft.h>

void	*ft_memset(void *str, int a, size_t len)
{
	char *temp;

	if (!str)
		return (NULL);
	temp = str;
	while (len-- > 0)
		*temp++ = (unsigned char)a;
	return (str);
}
